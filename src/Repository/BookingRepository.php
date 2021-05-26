<?php

namespace App\Repository;

use App\Entity\Booking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Booking find($id, $lockMode = null, $lockVersion = null)
 * @method null|Booking findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

    public function findBookingDashboardPerStation(int $stationId)
    {
        /**
         * I know that this is not the ideal, but I was
         * struggling to make this thing work with DQL and
         * decided to go to plain SQL. one another option
         * would be to create a function in MySQL, but there's
         * pros and cons about this approach.
         */
        $conn = $this->getEntityManager()->getConnection();
        $sql = 'SELECT
                DATE(booking.start_date) AS "date",
                ANY_VALUE(equipment.`name`) AS "equipment_name",
                ANY_VALUE(equipment.id) AS "equipment_id",
                SUM(booking_equipment.quantity) AS "quantity_booked",
                ANY_VALUE(station_equipment.quantity) AS "quantity_available"
            FROM
                booking_equipment
                LEFT JOIN booking ON booking.id = booking_equipment.booking_id
                LEFT JOIN equipment ON equipment.id = booking_equipment.equipment_id
                LEFT JOIN station ON station.id = booking.start_station_id
                LEFT JOIN station_equipment ON (
                    station_equipment.station_id = station.id
                    AND station_equipment.equipment_id = equipment.id
                )
            WHERE
                booking.start_station_id = ?
            GROUP BY
                DATE(booking.start_date), equipment.id
            ORDER BY
                DATE(booking.start_date) ASC';

        $statement = $conn->prepare($sql);
        $statement->bindValue(1, $stationId);
        $statement->executeQuery();

        $data = $statement->fetchAllAssociative();

        // the following block could be moved to a helper
        $response = [];

        // this next variable is to help me to do the calculation
        // of available quantity per equipment
        $equipmentAvailability = [];

        foreach ($data as $item) {
            $response[$item['date']] = $response[$item['date']] ?? [];
            $response[$item['date']]['date'] = $item['date'];

            $quantity_available = $equipmentAvailability[$item['equipment_id']] ?? $item['quantity_available'];

            $response[$item['date']]['equipments'][$item['equipment_id']] = [
                'quantity_available' => $quantity_available,
                'quantity_booked' => $item['quantity_booked'],
                'name' => $item['equipment_name'],
            ];

            $equipmentAvailability[$item['equipment_id']] = $quantity_available - $item['quantity_booked'];
        }

        $response = array_values($response);
        $response = array_map(function($item) {
            $item['equipments'] = array_values($item['equipments']);
            return $item;
        }, $response);

        return $response;
    }
}

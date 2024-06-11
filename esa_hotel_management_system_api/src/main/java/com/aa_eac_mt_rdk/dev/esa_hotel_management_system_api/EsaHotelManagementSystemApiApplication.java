package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api;

import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@SpringBootApplication
public class EsaHotelManagementSystemApiApplication {

	public static void main(String[] args) {
		SpringApplication.run(EsaHotelManagementSystemApiApplication.class, args);
	}

}


@Table(name = "t_room")
public class RoomEntity extends AbstractEntity{
	private String number;
	private String type;
	private String status;
	private String price;
}

@Table(name = "t_Manage")
public class ManagerEntity extends AbstractEntity{
	private String name;
}

@Table(name = "t_roomService")
public class RoomServiceEntity extends AbstractEntity{
	private String descrition;
	private String price;
}

@Table(name = "t_receptionist")
public class ReceptionistEntity extends AbstractEntity{
	private String name;
	private String cellphone;
	private String email;
}

@Table(name = "t_payment")
public class PaymentEntity extends AbstractEntity{
	private String type;
	private String total;
	private String paymentDate;
}

@Table(name = "t_report")
public class ReportEntity extends AbstractEntity{
	private String reportType;
	private String dateGenerated;
	private String content;
}
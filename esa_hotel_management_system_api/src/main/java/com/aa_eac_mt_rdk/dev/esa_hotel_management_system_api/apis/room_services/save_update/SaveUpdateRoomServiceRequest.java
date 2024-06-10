package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.room_services.save_update;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class SaveUpdateRoomServiceRequest {
    private Long id;
    private String description;
    private Double price;
}

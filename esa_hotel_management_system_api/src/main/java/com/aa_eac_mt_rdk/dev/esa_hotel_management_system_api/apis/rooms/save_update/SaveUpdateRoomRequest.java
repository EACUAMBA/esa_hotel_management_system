package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.save_update;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class SaveUpdateRoomRequest {
    private Long id;
    private String number;
    private String type;
    private String status;
    private Double pricePerNight;
}

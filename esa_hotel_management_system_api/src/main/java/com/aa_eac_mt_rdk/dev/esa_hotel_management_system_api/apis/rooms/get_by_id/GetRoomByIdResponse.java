package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_by_id;

import lombok.Getter;
import lombok.RequiredArgsConstructor;
import lombok.Setter;
import org.springframework.stereotype.Service;

@Getter
@Setter
public class GetRoomByIdResponse {
    private Long id;
    private String number;
    private String type;
    private String status;
    private Double pricePerNight;
}

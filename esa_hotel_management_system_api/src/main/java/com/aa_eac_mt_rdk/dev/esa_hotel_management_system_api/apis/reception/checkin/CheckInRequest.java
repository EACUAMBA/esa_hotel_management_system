package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reception.checkin;

import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;

@Getter
@Setter
public class CheckInRequest {
    private Long recepcionistaId;
    private Long roomId;
    private LocalDateTime startDateTime;
    private LocalDateTime endDateTime;
}

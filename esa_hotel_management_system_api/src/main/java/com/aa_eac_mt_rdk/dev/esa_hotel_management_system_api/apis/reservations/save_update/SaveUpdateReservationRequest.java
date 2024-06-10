package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reservations.save_update;

import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;

@Getter
@Setter
public class SaveUpdateReservationRequest {
    private Long id;
    private Long clientId;
    private Long roomId;
    private LocalDateTime startDate;
    private LocalDateTime endDate;
}

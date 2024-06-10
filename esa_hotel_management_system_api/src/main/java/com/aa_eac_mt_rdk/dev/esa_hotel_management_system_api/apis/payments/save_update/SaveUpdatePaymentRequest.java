package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.payments.save_update;

import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;

@Getter
@Setter
public class SaveUpdatePaymentRequest {
    private Long id;
    private String type;
    private Double total;
    private LocalDateTime paymentDate;
    private Long reservationId;
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.price_tables.save_update;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class SaveUpdatePriceTableRequest {
    private Long id;
    private String roomType;
    private Double value;
}

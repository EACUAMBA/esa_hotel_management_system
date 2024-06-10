package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.clients.save_update;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class SaveUpdateClientRequest {
    private Long id;
    private String name;
    private String email;
    private String phone;
    private String address;
}

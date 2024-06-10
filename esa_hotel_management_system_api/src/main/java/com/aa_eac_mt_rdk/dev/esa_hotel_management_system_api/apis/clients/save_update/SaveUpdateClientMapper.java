package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.clients.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ClientEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateClientMapper {
    public ClientEntity toEntity(SaveUpdateClientRequest request) {
        ClientEntity clientEntity = ClientEntity.builder()
                .id(request.getId())
                .name(request.getName())
                .email(request.getEmail())
                .phone(request.getPhone())
                .address(request.getAddress())
                .build();
        return clientEntity;
    }

    public SaveUpdateClientRequest toRequest(ClientEntity clientEntity) {
        SaveUpdateClientRequest request = new SaveUpdateClientRequest();
        request.setId(clientEntity.getId());
        request.setName(clientEntity.getName());
        request.setEmail(clientEntity.getEmail());
        request.setPhone(clientEntity.getPhone());
        request.setAddress(clientEntity.getAddress());
        return request;
    }
}

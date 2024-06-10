package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.managers.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.GerenteEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateManagerMapper {
    public GerenteEntity toEntity(SaveUpdateManagerRequest request) {
        return GerenteEntity.builder()
                .id(request.getId())
                .nome(request.getName())
                .build();
    }

    public SaveUpdateManagerRequest toRequest(GerenteEntity gerenteEntity) {
        SaveUpdateManagerRequest request = new SaveUpdateManagerRequest();
        request.setId(gerenteEntity.getId());
        request.setName(gerenteEntity.getNome());
        return request;
    }
}

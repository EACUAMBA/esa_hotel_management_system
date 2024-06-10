package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.receptionists.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.RecepcionistaEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateReceptionistMapper {
    public RecepcionistaEntity toEntity(SaveUpdateReceptionistRequest request) {
        RecepcionistaEntity recepcionistaEntity = RecepcionistaEntity.builder()
                .id(request.getId())
                .nome(request.getName())
                .email(request.getEmail())
                .telefone(request.getPhone())
                .build();
        return recepcionistaEntity;
    }

    public SaveUpdateReceptionistRequest toRequest(RecepcionistaEntity recepcionistaEntity) {
        SaveUpdateReceptionistRequest request = new SaveUpdateReceptionistRequest();
        request.setId(recepcionistaEntity.getId());
        request.setName(recepcionistaEntity.getNome());
        request.setEmail(recepcionistaEntity.getEmail());
        request.setPhone(recepcionistaEntity.getTelefone());
        return request;
    }
}

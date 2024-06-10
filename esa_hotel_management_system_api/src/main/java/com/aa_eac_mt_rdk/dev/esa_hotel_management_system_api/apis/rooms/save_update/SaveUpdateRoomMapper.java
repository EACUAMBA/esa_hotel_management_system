package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateRoomMapper {
    public QuartoEntity toEntity(SaveUpdateRoomRequest request) {
        QuartoEntity quartoEntity = QuartoEntity.builder()
                .id(request.getId())
                .numero(request.getNumber())
                .tipo(request.getType())
                .status(request.getStatus())
                .precoPorNoite(request.getPricePerNight())
                .build();
        return quartoEntity;
    }

    public SaveUpdateRoomRequest toRequest(QuartoEntity quartoEntity) {
        SaveUpdateRoomRequest request = new SaveUpdateRoomRequest();
        request.setId(quartoEntity.getId());
        request.setNumber(quartoEntity.getNumero());
        request.setType(quartoEntity.getTipo());
        request.setStatus(quartoEntity.getStatus());
        request.setPricePerNight(quartoEntity.getPrecoPorNoite());
        return request;
    }
}

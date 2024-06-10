package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_by_id;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import org.springframework.stereotype.Component;

@Component
public class GetRoomByIdMapper {
    public GetRoomByIdResponse toResponse(QuartoEntity quartoEntity) {
        GetRoomByIdResponse getRoomByIdResponse = new GetRoomByIdResponse();

        getRoomByIdResponse.setId(quartoEntity.getId());
        getRoomByIdResponse.setType(quartoEntity.getTipo());
        getRoomByIdResponse.setNumber(quartoEntity.getNumero());
        getRoomByIdResponse.setStatus(quartoEntity.getStatus());
        getRoomByIdResponse.setPricePerNight(quartoEntity.getPrecoPorNoite());

        return getRoomByIdResponse;
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_all;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import org.springframework.stereotype.Component;

import java.util.List;
import java.util.stream.Collectors;

@Component
public class GetAllRoomsMapper {
    public GetAllRoomsResponse toResponse(QuartoEntity quartoEntity) {
        GetAllRoomsResponse response = new GetAllRoomsResponse();
        response.setId(quartoEntity.getId());
        response.setNumber(quartoEntity.getNumero());
        response.setType(quartoEntity.getTipo());
        response.setStatus(quartoEntity.getStatus());
        response.setPricePerNight(quartoEntity.getPrecoPorNoite());
        return response;
    }

    public List<GetAllRoomsResponse> toResponseList(List<QuartoEntity> quartoEntities) {
        return quartoEntities.stream().map(this::toResponse).collect(Collectors.toList());
    }
}

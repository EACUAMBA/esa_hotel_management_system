package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.room_services.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ServicoDeQuartoEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateRoomServiceMapper {
    public ServicoDeQuartoEntity toEntity(SaveUpdateRoomServiceRequest request) {
        return ServicoDeQuartoEntity.builder()
                .id(request.getId())
                .descricao(request.getDescription())
                .preco(request.getPrice())
                .build();
    }

    public SaveUpdateRoomServiceRequest toRequest(ServicoDeQuartoEntity servicoDeQuartoEntity) {
        SaveUpdateRoomServiceRequest request = new SaveUpdateRoomServiceRequest();
        request.setId(servicoDeQuartoEntity.getId());
        request.setDescription(servicoDeQuartoEntity.getDescricao());
        request.setPrice(servicoDeQuartoEntity.getPreco());
        return request;
    }
}

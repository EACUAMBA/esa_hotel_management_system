package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.price_tables.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.TabelaDePrecosEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdatePriceTableMapper {
    public TabelaDePrecosEntity toEntity(SaveUpdatePriceTableRequest request) {
        return TabelaDePrecosEntity.builder()
                .id(request.getId())
                .tipoQuarto(request.getRoomType())
                .valor(request.getValue())
                .build();
    }

    public SaveUpdatePriceTableRequest toRequest(TabelaDePrecosEntity tabelaDePrecosEntity) {
        SaveUpdatePriceTableRequest request = new SaveUpdatePriceTableRequest();
        request.setId(tabelaDePrecosEntity.getId());
        request.setRoomType(tabelaDePrecosEntity.getTipoQuarto());
        request.setValue(tabelaDePrecosEntity.getValor());
        return request;
    }
}

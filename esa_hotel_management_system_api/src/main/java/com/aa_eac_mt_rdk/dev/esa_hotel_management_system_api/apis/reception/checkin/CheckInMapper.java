package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reception.checkin;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ReservaEntity;
import org.springframework.stereotype.Component;

@Component
public class CheckInMapper {
    public CheckInResponse toResponse(ReservaEntity reservaEntity) {
        CheckInResponse response = new CheckInResponse();
        response.setReservaId(reservaEntity.getId());
        response.setMessage("Check-in realizado com sucesso!");
        return response;
    }
}

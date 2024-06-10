package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reservations.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ReservaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ClientEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ClientRepository;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.QuartoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Component;

@Component
@RequiredArgsConstructor
public class SaveUpdateReservationMapper {
    private final ClientRepository clientRepository;
    private final QuartoRepository quartoRepository;

    public ReservaEntity toEntity(SaveUpdateReservationRequest request) {
        ClientEntity clientEntity = clientRepository.findById(request.getClientId()).orElse(null);
        QuartoEntity quartoEntity = quartoRepository.findById(request.getRoomId()).orElse(null);

        return ReservaEntity.builder()
                .id(request.getId())
                .cliente(clientEntity)
                .quarto(quartoEntity)
                .dataInicio(request.getStartDate())
                .dataFim(request.getEndDate())
                .build();
    }

    public SaveUpdateReservationRequest toRequest(ReservaEntity reservaEntity) {
        SaveUpdateReservationRequest request = new SaveUpdateReservationRequest();
        request.setId(reservaEntity.getId());
        request.setClientId(reservaEntity.getCliente().getId());
        request.setRoomId(reservaEntity.getQuarto().getId());
        request.setStartDate(reservaEntity.getDataInicio());
        request.setEndDate(reservaEntity.getDataFim());
        return request;
    }
}

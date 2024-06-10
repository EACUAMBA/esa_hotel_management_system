package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reception.checkin;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.RecepcionistaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ReservaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.QuartoRepository;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.RecepcionistaRepository;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ReservaRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
@RequiredArgsConstructor
public class CheckInService {
    private final ReservaRepository reservaRepository;
    private final RecepcionistaRepository recepcionistaRepository;
    private final QuartoRepository quartoRepository;
    private final CheckInMapper checkInMapper;

    public ResponseEntity<CheckInResponse> checkIn(CheckInRequest request) {
        Optional<RecepcionistaEntity> recepcionistaOpt = recepcionistaRepository.findById(request.getRecepcionistaId());
        Optional<QuartoEntity> quartoOpt = quartoRepository.findById(request.getRoomId());

        if (recepcionistaOpt.isPresent() && quartoOpt.isPresent()) {
            ReservaEntity reserva = ReservaEntity.builder()
                    .cliente(null) // O cliente deve ser associado aqui conforme necessário
                    .quarto(quartoOpt.get())
                    .dataInicio(request.getStartDateTime())
                    .dataFim(request.getEndDateTime())
                    .build();
            reservaRepository.save(reserva);

            CheckInResponse response = checkInMapper.toResponse(reserva);
            return ResponseEntity.ok(response);
        }

        return ResponseEntity.badRequest().build();
    }
}

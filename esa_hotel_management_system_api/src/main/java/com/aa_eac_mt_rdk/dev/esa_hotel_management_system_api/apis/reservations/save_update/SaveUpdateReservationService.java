package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reservations.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ReservaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ReservaRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateReservationService {
    private final ReservaRepository reservaRepository;
    private final SaveUpdateReservationMapper saveUpdateReservationMapper;

    public ResponseEntity<SaveUpdateReservationRequest> saveOrUpdateReservation(SaveUpdateReservationRequest request) {
        ReservaEntity reservaEntity = saveUpdateReservationMapper.toEntity(request);
        ReservaEntity savedEntity = reservaRepository.save(reservaEntity);
        SaveUpdateReservationRequest response = saveUpdateReservationMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

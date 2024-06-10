package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.room_services.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ServicoDeQuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ServicoDeQuartoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateRoomServiceService {
    private final ServicoDeQuartoRepository servicoDeQuartoRepository;
    private final SaveUpdateRoomServiceMapper saveUpdateRoomServiceMapper;

    public ResponseEntity<SaveUpdateRoomServiceRequest> saveOrUpdateRoomService(SaveUpdateRoomServiceRequest request) {
        ServicoDeQuartoEntity servicoDeQuartoEntity = saveUpdateRoomServiceMapper.toEntity(request);
        ServicoDeQuartoEntity savedEntity = servicoDeQuartoRepository.save(servicoDeQuartoEntity);
        SaveUpdateRoomServiceRequest response = saveUpdateRoomServiceMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

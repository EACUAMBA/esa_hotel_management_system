package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.QuartoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateRoomService {
    private final QuartoRepository quartoRepository;
    private final SaveUpdateRoomMapper saveUpdateRoomMapper;

    public ResponseEntity<SaveUpdateRoomRequest> saveOrUpdateRoom(SaveUpdateRoomRequest request) {
        QuartoEntity quartoEntity = saveUpdateRoomMapper.toEntity(request);
        QuartoEntity savedEntity = quartoRepository.save(quartoEntity);
        SaveUpdateRoomRequest response = saveUpdateRoomMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

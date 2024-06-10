package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_by_id;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.QuartoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.Optional;

@Service
@RequiredArgsConstructor
public class GetRoomByIdService {
    private final QuartoRepository quartoRepository;
    private final GetRoomByIdMapper getRoomByIdMapper;

    public ResponseEntity<GetRoomByIdResponse> getById(Long id) {

        Optional<QuartoEntity> quartoEntityOptional = this.quartoRepository.findById(id);

        if (quartoEntityOptional.isPresent()) {
            QuartoEntity quartoEntity = quartoEntityOptional.get();
            GetRoomByIdResponse getRoomByIdResponse = this.getRoomByIdMapper.toResponse(quartoEntity);
            return ResponseEntity.ok(getRoomByIdResponse);
        }

        throw new RuntimeException("Room not found!");
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.get_all;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.QuartoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.QuartoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class GetAllRoomsService {
    private final QuartoRepository quartoRepository;
    private final GetAllRoomsMapper getAllRoomsMapper;

    public ResponseEntity<List<GetAllRoomsResponse>> getAllRooms() {
        List<QuartoEntity> quartoEntities = quartoRepository.findAll();
        List<GetAllRoomsResponse> responseList = getAllRoomsMapper.toResponseList(quartoEntities);
        return ResponseEntity.ok(responseList);
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.managers.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.GerenteEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.GerenteRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateManagerService {
    private final GerenteRepository gerenteRepository;
    private final SaveUpdateManagerMapper saveUpdateManagerMapper;

    public ResponseEntity<SaveUpdateManagerRequest> saveOrUpdateManager(SaveUpdateManagerRequest request) {
        GerenteEntity gerenteEntity = saveUpdateManagerMapper.toEntity(request);
        GerenteEntity savedEntity = gerenteRepository.save(gerenteEntity);
        SaveUpdateManagerRequest response = saveUpdateManagerMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

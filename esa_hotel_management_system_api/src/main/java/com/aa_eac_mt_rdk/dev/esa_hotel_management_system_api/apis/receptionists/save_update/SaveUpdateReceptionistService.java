package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.receptionists.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.RecepcionistaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.RecepcionistaRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateReceptionistService {
    private final RecepcionistaRepository recepcionistaRepository;
    private final SaveUpdateReceptionistMapper saveUpdateReceptionistMapper;

    public ResponseEntity<SaveUpdateReceptionistRequest> saveOrUpdateReceptionist(SaveUpdateReceptionistRequest request) {
        RecepcionistaEntity recepcionistaEntity = saveUpdateReceptionistMapper.toEntity(request);
        RecepcionistaEntity savedEntity = recepcionistaRepository.save(recepcionistaEntity);
        SaveUpdateReceptionistRequest response = saveUpdateReceptionistMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

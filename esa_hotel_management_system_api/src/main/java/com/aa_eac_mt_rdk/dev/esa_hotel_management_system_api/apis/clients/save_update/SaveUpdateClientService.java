package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.clients.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ClientEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ClientRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateClientService {
    private final ClientRepository clientRepository;
    private final SaveUpdateClientMapper saveUpdateClientMapper;

    public ResponseEntity<SaveUpdateClientRequest> saveOrUpdateClient(SaveUpdateClientRequest request) {
        ClientEntity clientEntity = saveUpdateClientMapper.toEntity(request);
        ClientEntity savedEntity = clientRepository.save(clientEntity);
        SaveUpdateClientRequest response = saveUpdateClientMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

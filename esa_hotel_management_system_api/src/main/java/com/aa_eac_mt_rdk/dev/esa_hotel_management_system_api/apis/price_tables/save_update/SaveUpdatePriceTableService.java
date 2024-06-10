package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.price_tables.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.TabelaDePrecosEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.TabelaDePrecosRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdatePriceTableService {
    private final TabelaDePrecosRepository tabelaDePrecosRepository;
    private final SaveUpdatePriceTableMapper saveUpdatePriceTableMapper;

    public ResponseEntity<SaveUpdatePriceTableRequest> saveOrUpdatePriceTable(SaveUpdatePriceTableRequest request) {
        TabelaDePrecosEntity tabelaDePrecosEntity = saveUpdatePriceTableMapper.toEntity(request);
        TabelaDePrecosEntity savedEntity = tabelaDePrecosRepository.save(tabelaDePrecosEntity);
        SaveUpdatePriceTableRequest response = saveUpdatePriceTableMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

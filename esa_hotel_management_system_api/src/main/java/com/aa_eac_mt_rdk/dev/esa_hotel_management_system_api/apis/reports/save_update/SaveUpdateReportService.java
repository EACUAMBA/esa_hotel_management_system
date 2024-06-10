package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reports.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.RelatorioEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.RelatorioRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateReportService {
    private final RelatorioRepository relatorioRepository;
    private final SaveUpdateReportMapper saveUpdateReportMapper;

    public ResponseEntity<SaveUpdateReportRequest> saveOrUpdateReport(SaveUpdateReportRequest request) {
        RelatorioEntity relatorioEntity = saveUpdateReportMapper.toEntity(request);
        RelatorioEntity savedEntity = relatorioRepository.save(relatorioEntity);
        SaveUpdateReportRequest response = saveUpdateReportMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

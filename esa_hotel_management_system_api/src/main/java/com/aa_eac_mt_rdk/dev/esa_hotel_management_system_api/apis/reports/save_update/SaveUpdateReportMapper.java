package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reports.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.RelatorioEntity;
import org.springframework.stereotype.Component;

@Component
public class SaveUpdateReportMapper {
    public RelatorioEntity toEntity(SaveUpdateReportRequest request) {
        return RelatorioEntity.builder()
                .id(request.getId())
                .tipoRelatorio(request.getReportType())
                .dataGerado(request.getGeneratedDate())
                .conteudo(request.getContent())
                .build();
    }

    public SaveUpdateReportRequest toRequest(RelatorioEntity relatorioEntity) {
        SaveUpdateReportRequest request = new SaveUpdateReportRequest();
        request.setId(relatorioEntity.getId());
        request.setReportType(relatorioEntity.getTipoRelatorio());
        request.setGeneratedDate(relatorioEntity.getDataGerado());
        request.setContent(relatorioEntity.getConteudo());
        return request;
    }
}

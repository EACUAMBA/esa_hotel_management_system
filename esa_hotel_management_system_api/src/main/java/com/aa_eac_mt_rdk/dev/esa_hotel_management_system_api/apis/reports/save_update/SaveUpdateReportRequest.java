package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reports.save_update;

import lombok.Getter;
import lombok.Setter;

import java.time.LocalDateTime;

@Getter
@Setter
public class SaveUpdateReportRequest {
    private Long id;
    private String reportType;
    private LocalDateTime generatedDate;
    private String content;
}

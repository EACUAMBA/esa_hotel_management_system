package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reports.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "reports")
public class SaveUpdateReportController {
    private final SaveUpdateReportService saveUpdateReportService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateReportRequest> saveReport(@RequestBody SaveUpdateReportRequest request) {
        return saveUpdateReportService.saveOrUpdateReport(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateReportRequest> updateReport(@PathVariable Long id, @RequestBody SaveUpdateReportRequest request) {
        request.setId(id);
        return saveUpdateReportService.saveOrUpdateReport(request);
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.managers.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "managers")
public class SaveUpdateManagerController {
    private final SaveUpdateManagerService saveUpdateManagerService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateManagerRequest> saveManager(@RequestBody SaveUpdateManagerRequest request) {
        return saveUpdateManagerService.saveOrUpdateManager(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateManagerRequest> updateManager(@PathVariable Long id, @RequestBody SaveUpdateManagerRequest request) {
        request.setId(id);
        return saveUpdateManagerService.saveOrUpdateManager(request);
    }
}

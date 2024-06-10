package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.clients.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "clients")
public class SaveUpdateClientController {
    private final SaveUpdateClientService saveUpdateClientService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateClientRequest> saveClient(@RequestBody SaveUpdateClientRequest request) {
        return saveUpdateClientService.saveOrUpdateClient(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateClientRequest> updateClient(@PathVariable Long id, @RequestBody SaveUpdateClientRequest request) {
        request.setId(id);
        return saveUpdateClientService.saveOrUpdateClient(request);
    }
}

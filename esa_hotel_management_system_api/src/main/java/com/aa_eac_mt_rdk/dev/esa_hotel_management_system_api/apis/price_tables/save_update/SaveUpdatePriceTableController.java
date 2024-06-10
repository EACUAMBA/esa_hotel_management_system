package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.price_tables.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "price_tables")
public class SaveUpdatePriceTableController {
    private final SaveUpdatePriceTableService saveUpdatePriceTableService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdatePriceTableRequest> savePriceTable(@RequestBody SaveUpdatePriceTableRequest request) {
        return saveUpdatePriceTableService.saveOrUpdatePriceTable(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdatePriceTableRequest> updatePriceTable(@PathVariable Long id, @RequestBody SaveUpdatePriceTableRequest request) {
        request.setId(id);
        return saveUpdatePriceTableService.saveOrUpdatePriceTable(request);
    }
}

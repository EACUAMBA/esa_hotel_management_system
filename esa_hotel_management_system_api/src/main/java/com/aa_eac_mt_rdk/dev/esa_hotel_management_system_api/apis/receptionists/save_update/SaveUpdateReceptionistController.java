package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.receptionists.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "receptionists")
public class SaveUpdateReceptionistController {
    private final SaveUpdateReceptionistService saveUpdateReceptionistService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateReceptionistRequest> saveReceptionist(@RequestBody SaveUpdateReceptionistRequest request) {
        return saveUpdateReceptionistService.saveOrUpdateReceptionist(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateReceptionistRequest> updateReceptionist(@PathVariable Long id, @RequestBody SaveUpdateReceptionistRequest request) {
        request.setId(id);
        return saveUpdateReceptionistService.saveOrUpdateReceptionist(request);
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.reservations.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "reservations")
public class SaveUpdateReservationController {
    private final SaveUpdateReservationService saveUpdateReservationService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateReservationRequest> saveReservation(@RequestBody SaveUpdateReservationRequest request) {
        return saveUpdateReservationService.saveOrUpdateReservation(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateReservationRequest> updateReservation(@PathVariable Long id, @RequestBody SaveUpdateReservationRequest request) {
        request.setId(id);
        return saveUpdateReservationService.saveOrUpdateReservation(request);
    }
}

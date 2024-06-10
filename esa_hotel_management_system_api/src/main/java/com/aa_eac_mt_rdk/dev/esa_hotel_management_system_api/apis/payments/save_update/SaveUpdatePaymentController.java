package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.payments.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "payments")
public class SaveUpdatePaymentController {
    private final SaveUpdatePaymentService saveUpdatePaymentService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdatePaymentRequest> savePayment(@RequestBody SaveUpdatePaymentRequest request) {
        return saveUpdatePaymentService.saveOrUpdatePayment(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdatePaymentRequest> updatePayment(@PathVariable Long id, @RequestBody SaveUpdatePaymentRequest request) {
        request.setId(id);
        return saveUpdatePaymentService.saveOrUpdatePayment(request);
    }
}

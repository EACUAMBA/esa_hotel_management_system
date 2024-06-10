package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.feedbacks.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "feedbacks")
public class SaveUpdateFeedbackController {
    private final SaveUpdateFeedbackService saveUpdateFeedbackService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateFeedbackRequest> saveFeedback(@RequestBody SaveUpdateFeedbackRequest request) {
        return saveUpdateFeedbackService.saveOrUpdateFeedback(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateFeedbackRequest> updateFeedback(@PathVariable Long id, @RequestBody SaveUpdateFeedbackRequest request) {
        request.setId(id);
        return saveUpdateFeedbackService.saveOrUpdateFeedback(request);
    }
}

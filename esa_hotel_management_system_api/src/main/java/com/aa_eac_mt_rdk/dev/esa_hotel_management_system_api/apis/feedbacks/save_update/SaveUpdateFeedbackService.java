package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.feedbacks.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.FeedbackEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.FeedbackRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdateFeedbackService {
    private final FeedbackRepository feedbackRepository;
    private final SaveUpdateFeedbackMapper saveUpdateFeedbackMapper;

    public ResponseEntity<SaveUpdateFeedbackRequest> saveOrUpdateFeedback(SaveUpdateFeedbackRequest request) {
        FeedbackEntity feedbackEntity = saveUpdateFeedbackMapper.toEntity(request);
        FeedbackEntity savedEntity = feedbackRepository.save(feedbackEntity);
        SaveUpdateFeedbackRequest response = saveUpdateFeedbackMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

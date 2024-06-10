package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.feedbacks.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.FeedbackEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ClientEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ClientRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Component;

@Component
@RequiredArgsConstructor
public class SaveUpdateFeedbackMapper {
    private final ClientRepository clientRepository;

    public FeedbackEntity toEntity(SaveUpdateFeedbackRequest request) {
        ClientEntity clientEntity = clientRepository.findById(request.getClientId()).orElse(null);

        return FeedbackEntity.builder()
                .id(request.getId())
                .cliente(clientEntity)
                .comentario(request.getComment())
                .avaliacao(request.getRating())
                .build();
    }

    public SaveUpdateFeedbackRequest toRequest(FeedbackEntity feedbackEntity) {
        SaveUpdateFeedbackRequest request = new SaveUpdateFeedbackRequest();
        request.setId(feedbackEntity.getId());
        request.setClientId(feedbackEntity.getCliente().getId());
        request.setComment(feedbackEntity.getComentario());
        request.setRating(feedbackEntity.getAvaliacao());
        return request;
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.feedbacks.save_update;

import lombok.Getter;
import lombok.Setter;

@Getter
@Setter
public class SaveUpdateFeedbackRequest {
    private Long id;
    private Long clientId;
    private String comment;
    private Integer rating;
}

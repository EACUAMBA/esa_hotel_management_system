// FeedbackRepository.java
package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.FeedbackEntity;
import org.springframework.data.jpa.repository.JpaRepository;

public interface FeedbackRepository extends JpaRepository<FeedbackEntity, Long> {
}

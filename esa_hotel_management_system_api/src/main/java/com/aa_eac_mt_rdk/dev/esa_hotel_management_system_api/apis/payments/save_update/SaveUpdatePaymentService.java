package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.payments.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.PagamentoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.PagamentoRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

@Service
@RequiredArgsConstructor
public class SaveUpdatePaymentService {
    private final PagamentoRepository pagamentoRepository;
    private final SaveUpdatePaymentMapper saveUpdatePaymentMapper;

    public ResponseEntity<SaveUpdatePaymentRequest> saveOrUpdatePayment(SaveUpdatePaymentRequest request) {
        PagamentoEntity pagamentoEntity = saveUpdatePaymentMapper.toEntity(request);
        PagamentoEntity savedEntity = pagamentoRepository.save(pagamentoEntity);
        SaveUpdatePaymentRequest response = saveUpdatePaymentMapper.toRequest(savedEntity);
        return ResponseEntity.ok(response);
    }
}

package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.payments.save_update;

import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.PagamentoEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities.ReservaEntity;
import com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.repositories.ReservaRepository;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Component;

@Component
@RequiredArgsConstructor
public class SaveUpdatePaymentMapper {
    private final ReservaRepository reservaRepository;

    public PagamentoEntity toEntity(SaveUpdatePaymentRequest request) {
        ReservaEntity reservaEntity = reservaRepository.findById(request.getReservationId()).orElse(null);

        return PagamentoEntity.builder()
                .id(request.getId())
                .tipo(request.getType())
                .total(request.getTotal())
                .dataPagamento(request.getPaymentDate())
                .reserva(reservaEntity)
                .build();
    }

    public SaveUpdatePaymentRequest toRequest(PagamentoEntity pagamentoEntity) {
        SaveUpdatePaymentRequest request = new SaveUpdatePaymentRequest();
        request.setId(pagamentoEntity.getId());
        request.setType(pagamentoEntity.getTipo());
        request.setTotal(pagamentoEntity.getTotal());
        request.setPaymentDate(pagamentoEntity.getDataPagamento());
        request.setReservationId(pagamentoEntity.getReserva().getId());
        return request;
    }
}

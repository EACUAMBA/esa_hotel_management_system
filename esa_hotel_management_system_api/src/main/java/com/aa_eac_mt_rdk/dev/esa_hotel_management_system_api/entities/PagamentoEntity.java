package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

import java.time.LocalDateTime;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@SuperBuilder(toBuilder = true)
@Entity
@Table(name = "t_pagamento")
public class PagamentoEntity extends AbstractEntity {
    private String tipo;
    private Double total;
    
    private LocalDateTime dataPagamento;
    
    @ManyToOne
    @JoinColumn(name = "reserva_id")
    private ReservaEntity reserva;
}

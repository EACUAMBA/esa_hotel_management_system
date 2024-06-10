package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

import java.util.Date;

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
    
    @Temporal(TemporalType.DATE)
    private Date dataPagamento;
    
    @ManyToOne
    @JoinColumn(name = "reserva_id")
    private ReservaEntity reserva;
}

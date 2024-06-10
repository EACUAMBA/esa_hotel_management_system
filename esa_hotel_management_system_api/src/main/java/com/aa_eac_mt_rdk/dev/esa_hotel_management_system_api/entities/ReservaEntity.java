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
@Table(name = "t_reserva")
public class ReservaEntity extends AbstractEntity {
    private LocalDateTime dataInicio;
    private LocalDateTime dataFim;

    @ManyToOne
    @JoinColumn(name = "cliente_id")
    private ClientEntity cliente;

    @ManyToOne
    @JoinColumn(name = "quarto_id")
    private QuartoEntity quarto;
}

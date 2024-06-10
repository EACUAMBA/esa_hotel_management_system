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
@Table(name = "t_reserva")
public class ReservaEntity extends AbstractEntity {
    @Temporal(TemporalType.DATE)
    private Date dataInicio;
    
    @Temporal(TemporalType.DATE)
    private Date dataFim;
    
    @ManyToOne
    @JoinColumn(name = "cliente_id")
    private ClientEntity cliente;
    
    @ManyToOne
    @JoinColumn(name = "quarto_id")
    private QuartoEntity quarto;
}

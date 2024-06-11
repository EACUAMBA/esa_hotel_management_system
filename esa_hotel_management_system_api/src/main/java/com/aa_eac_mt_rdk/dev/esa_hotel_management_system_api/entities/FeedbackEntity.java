package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.entities;

import jakarta.persistence.*;
import lombok.*;
import lombok.experimental.SuperBuilder;

@Getter
@Setter
@AllArgsConstructor
@NoArgsConstructor
@SuperBuilder(toBuilder = true)
@Entity
@Table(name = "t_feedback")
public class FeedbackEntity extends AbstractEntity {
    private String comentario;
    private Integer avaliacao;
    
    @ManyToOne
    @JoinColumn(name = "cliente_id")
    private ClientEntity cliente;
}

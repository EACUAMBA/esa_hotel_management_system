package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.room_services.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "room_services")
public class SaveUpdateRoomServiceController {
    private final SaveUpdateRoomServiceService saveUpdateRoomServiceService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateRoomServiceRequest> saveRoomService(@RequestBody SaveUpdateRoomServiceRequest request) {
        return saveUpdateRoomServiceService.saveOrUpdateRoomService(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateRoomServiceRequest> updateRoomService(@PathVariable Long id, @RequestBody SaveUpdateRoomServiceRequest request) {
        request.setId(id);
        return saveUpdateRoomServiceService.saveOrUpdateRoomService(request);
    }
}

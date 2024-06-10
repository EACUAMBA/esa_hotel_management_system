package com.aa_eac_mt_rdk.dev.esa_hotel_management_system_api.apis.rooms.save_update;

import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequiredArgsConstructor
@RequestMapping(path = "rooms")
public class SaveUpdateRoomController {
    private final SaveUpdateRoomService saveUpdateRoomService;

    @PostMapping(path = "save")
    public ResponseEntity<SaveUpdateRoomRequest> saveRoom(@RequestBody SaveUpdateRoomRequest request) {
        return saveUpdateRoomService.saveOrUpdateRoom(request);
    }

    @PutMapping(path = "update/{id}")
    public ResponseEntity<SaveUpdateRoomRequest> updateRoom(@PathVariable Long id, @RequestBody SaveUpdateRoomRequest request) {
        request.setId(id);
        return saveUpdateRoomService.saveOrUpdateRoom(request);
    }
}

<?php defined('BASEPATH') or exit('No direct script access allowed');

class Notif_model extends CI_Model
{
    // ========================================================================
    // ADMIN
    public function notif_admin()
    {
        // count untuk notif admin
        $query = $this->db->get_where('tb_notif_admin', ['read' => 'N']);
        return $query->num_rows();
    }
    public function update_read()
    {
        $params['read'] = 'Y';

        $this->db->where('read', 'N');
        $this->db->update('tb_notif_admin', $params);
    }
    public function get_notif_admin()
    {
        $this->db->from('tb_notif_admin');
        $this->db->limit(10);
        $this->db->order_by('notif_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }
    // hapus notif di admin
    public function del_notif_admin($lokerid)
    {
        $this->db->where('loker_id', $lokerid);
        $this->db->delete('tb_notif_admin');
    }

    // ========================================================================
    // Perusahaan
    public function notif_perusahaan()
    {
        // count untuk notif perusahaan
        $id = $this->fungsi->user_perusahaan()->perusahaan_id;

        $this->db->select('notif_id');
        $this->db->from('tb_notif_perusahaan');
        $this->db->where('perusahaan_id', $id);
        $this->db->where('read_perusahaan', 'N');
        $query = $this->db->get();

        return $query->num_rows();
    }
    public function update_read_perusahaan()
    {
        $params['read_perusahaan'] = 'Y';
        $id = $this->fungsi->user_perusahaan()->perusahaan_id;

        $this->db->where('perusahaan_id', $id);
        $this->db->where('read_perusahaan', 'N');
        $this->db->update('tb_notif_perusahaan', $params);
    }

    public function get_notif_perusahaan($id = null)
    {
        $this->db->from('tb_notif_perusahaan');
        if ($id != null) {
            $this->db->where('perusahaan_id', $id);
        }
        $this->db->limit(5);
        $this->db->order_by('notif_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    public function del_notif_perusahaan_by_id($notifid)
    {
        $this->db->where('notif_id', $notifid);
        $this->db->delete('tb_notif_perusahaan');
    }

    // hapus notif di perusahaan jika pengajuan dihapus admin
    public function del_notif_perusahaan($lokerid, $pd_id, $perusahaan_id)
    {
        $this->db->where('loker_id', $lokerid);
        $this->db->where('pd_id', $pd_id);
        $this->db->where('perusahaan_id', $perusahaan_id);
        $this->db->delete('tb_notif_perusahaan');
    }

    // ========================================================================
    // PD
    public function notif_pd()
    {
        // count untuk notif pd
        $id = $this->fungsi->user_pd()->pd_id;
        $query = $this->db->query("select notif_id from tb_notif where pd_id = '$id' AND read_pd = 'N'");

        return $query->num_rows();
    }
    public function update_read_pd()
    {
        $params['read_pd'] = 'Y';
        $id = $this->fungsi->user_pd()->pd_id;

        $this->db->where('pd_id', $id);
        $this->db->where('read_pd', 'N');
        $this->db->update('tb_notif', $params);
    }

    public function get_pd($id)
    {
        $this->db->select('pd_id');
        $this->db->from('tb_pd');
        $this->db->where('user_id', $id);

        $query = $this->db->get();
        return $query;
    }

    public function get_notif($id = null)
    {
        $this->db->from('tb_notif');
        if ($id != null) {
            $this->db->where('pd_id', $id);
        }
        $this->db->order_by('notif_id', 'DESC');

        $query = $this->db->get();
        return $query;
    }

    // hapus notif di PD jika pengajuan dihapus admin
    public function del_notif($lokerid, $pd_id)
    {
        $this->db->where('loker_id', $lokerid);
        $this->db->where('pd_id', $pd_id);
        $this->db->delete('tb_notif');
    }
}

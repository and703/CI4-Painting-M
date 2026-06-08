<?php
namespace App\Controllers;

use App\Models\ParkingSlotModel;

class ParkingDisplayController extends BaseController
{
    private $model;

    public function __construct()
    {
        $this->model = new ParkingSlotModel();
    }

    private function getCardColor($status)
    {
        $colors = [
            'curing'  => '#dc3545',
            'expired' => '#c617ff',
            'ready'   => '#ffc107',
            'empty'   => '#34a11d',
        ];
        return $colors[$status] ?? '#34a11d';
    }

    private function renderCard($slot, $painting = null, $status = 'empty', $blink = '', $link = '')
    {
        $color = $this->getCardColor($status);
        $cardClass = "card rounded-pill shadow-sm";
        $headerStyle = "background-color: $color; padding-left: 0px;";
        $bodyStyle = "background-color: $color; padding-left: 30px; padding-right: 30px;";
        $footerStyle = "background-color: $color; border-top-width: 0px;";

        $content = '';
        if ($status === 'empty') {
            $content = '<ul class="list-unstyled" style="margin-bottom: 92px;"><li></li></ul>';
        } else {
            $content = '
                <ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;">
                    <li>' . esc($painting['MAT_IP_CODE']) . '</li>
                </ul>
                <ul class="list-unstyled" style="margin-bottom: 0px; font-size: 100%;">
                    <li>' . esc($painting['Amount']) . '</li>
                </ul>
                <ul class="list-unstyled" style="margin-bottom: 0px; font-size: 150%;">
                    <li>' . esc($painting['timeCure']) . '</li>
                </ul>';
        }

        $output = '<div class="col">';
        if ($link) {
            $output .= '<a href="' . esc($link, 'attr') . '">';
        }

        $output .= '<div class="' . $cardClass . '">';
        $output .= '<div class="card-header py-1 ' . $blink . '" style="' . $headerStyle . '"></div>';
        $output .= '<div class="card-body ' . $blink . '" style="' . $bodyStyle . '">';
        $output .= '<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;">' . esc($slot) . '</h1>';
        $output .= $content;
        $output .= '</div>';
        $output .= '<div class="card-footer py-1 ' . $blink . '" style="' . $footerStyle . '"></div>';
        $output .= '</div>';

        if ($link) {
            $output .= '</a>';
        }
        $output .= '</div>';

        return $output;
    }

    private function renderFormCard($slot, $painting, $status, $parkType, $formAction)
    {
        $color = $this->getCardColor($status);
        $formId = esc($slot);

        $output = '<div class="col">';
        $output .= '<form id="' . $formId . '" action="' . $formAction . '" method="post">';
        $output .= csrf_field(false);
        $output .= '<input type="hidden" name="id" value="' . esc($painting['id']) . '">';
        $output .= '<input type="hidden" name="Park" value="' . esc($painting['Park']) . '">';
        $output .= '<input type="hidden" name="T_Park" value="' . esc($parkType) . '">';
        $output .= '<input type="hidden" name="CURE_TIME" value="' . esc($painting['timeCure']) . '">';
        $output .= '<a href="javascript:;" onclick="if (confirm(\'Are you sure TakeOut Manual\\r\\n Park : ' . esc($slot) . '\\r\\n IP : ' . esc($painting['MAT_IP_CODE']) . '\')) parentNode.submit(); else return false;">';

        $output .= '<div class="card rounded-pill shadow-sm">';
        $output .= '<div class="card-header py-1" style="background-color: ' . $color . '; padding-left: 0px;"></div>';
        $output .= '<div class="card-body" style="background-color: ' . $color . '; padding-left: 30px; padding-right: 30px;">';
        $output .= '<h1 class="card-title pricing-card-title" style="font-size: 150%; padding-left: 0px;">' . esc($slot) . '</h1>';
        $output .= '<ul class="list-unstyled" style="margin-bottom: 0px; font-weight:bold; font-size: 100%;"><li>' . esc($painting['MAT_IP_CODE']) . '</li></ul>';
        $output .= '<ul class="list-unstyled" style="margin-bottom: 0px; font-size: 100%;"><li>' . esc($painting['Amount']) . '</li></ul>';
        $output .= '<ul class="list-unstyled" style="margin-bottom: 0px; font-size: 150%;"><li>' . esc($painting['timeCure']) . '</li></ul>';
        $output .= '</div>';
        $output .= '<div class="card-footer py-1" style="background-color: ' . $color . '; border-top-width: 0px;"></div>';
        $output .= '</div>';

        $output .= '</a></form></div>';

        return $output;
    }

    public function display($type, $variant = 'basic', $ip = '')
    {
        $ip = $this->request->getGet('ip') ?: $ip;
        $html = '';

        if ($ip !== '') {
            $slots = $this->model->getFifoSlots($type, $ip);
            foreach ($slots as $row) {
                $painting = $this->model->getPaintingWithStatus($row['id']);
                if ($painting) {
                    $blink = 'blink';
                    $html .= $this->renderCard($row['slot'], $painting, $painting['status'], $blink);
                }
            }
        } else {
            $slots = $this->model->getSlots($type);
            foreach ($slots as $row) {
                if ($row['id_paint'] != 0) {
                    $painting = $this->model->getPaintingWithStatus($row['id_paint']);
                    if ($painting) {
                        $link = ($variant === 'interactive') ? '/p_park/' . $row['id_paint'] : '';
                        $html .= $this->renderCard($row['slot'], $painting, $painting['status'], '', $link);
                    }
                } else {
                    $html .= $this->renderCard($row['slot'], null, 'empty');
                }
            }
        }

        return $this->response->setBody($html);
    }

    public function displayManual($type, $variant = 'basic', $ip = '')
    {
        $ip = $this->request->getGet('ip') ?: $ip;
        $html = '';
        $parkType = $type;
        $formAction = site_url('worker/tagconf_manual');

        if ($ip !== '') {
            $slots = $this->model->getFifoSlots($type, $ip);
            foreach ($slots as $row) {
                $painting = $this->model->getPaintingWithStatus($row['id']);
                if ($painting) {
                    if ($variant === 'form') {
                        $html .= $this->renderFormCard($row['slot'], $painting, $painting['status'], $parkType, $formAction);
                    } else {
                        $html .= $this->renderCard($row['slot'], $painting, $painting['status'], 'blink');
                    }
                }
            }
        } else {
            $slots = $this->model->getSlots($type);
            foreach ($slots as $row) {
                if ($row['id_paint'] != 0) {
                    $painting = $this->model->getPaintingWithStatus($row['id_paint']);
                    if ($painting) {
                        if ($variant === 'form') {
                            $html .= $this->renderFormCard($row['slot'], $painting, $painting['status'], $parkType, $formAction);
                        } elseif ($variant === 'interactive') {
                            $html .= $this->renderCard($row['slot'], $painting, $painting['status'], '', '/p_park/' . $row['id_paint']);
                        } else {
                            $html .= $this->renderCard($row['slot'], $painting, $painting['status']);
                        }
                    }
                } else {
                    $html .= $this->renderCard($row['slot'], null, 'empty');
                }
            }
        }

        return $this->response->setBody($html);
    }

    public function displayBuff($variant = 'basic', $ip = '')
    {
        $ip = $this->request->getGet('ip') ?: $ip;
        $html = '';

        if ($ip !== '') {
            $slots = $this->model->getFifoSlots('B', $ip);
            foreach ($slots as $row) {
                $painting = $this->model->getPaintingWithStatus($row['id']);
                if ($painting) {
                    $html .= $this->renderCard($row['slot'], $painting, $painting['status'], 'blink');
                }
            }
        } else {
            $slots = $this->model->getBuffStockSlots();
            foreach ($slots as $row) {
                $painting = $this->model->getPaintingWithStatus($row['id_paint']);
                if ($painting) {
                    $html .= $this->renderCard($row['slot'] ?? '-', $painting, $painting['status']);
                }
            }
        }

        return $this->response->setBody($html);
    }

    public function checkIp()
    {
        $keyword = $this->request->getPost('keyword') ?: '';
        $result = $this->model->checkIpCode($keyword);

        if ($result) {
            $map = [
                '0' => ['label' => 'Outside Process', 'mch' => 'M1'],
                '1' => ['label' => 'Inside Process', 'mch' => 'M2'],
                '2' => ['label' => 'Outside+Inside Process', 'mch' => 'M3'],
            ];
            $info = $map[$result['CAT_IP']] ?? null;
            if ($info) {
                return $this->response->setBody(
                    '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">' . $info['label'] . '</h5>
                     <input type="hidden" name="mch" value="' . $info['mch'] . '">'
                );
            }
        }

        return $this->response->setBody('');
    }

    public function checkId()
    {
        $id = $this->request->getPost('id') ?: '';
        $result = $this->model->checkPaintingId($id);

        if ($result && $result['M_id'] == '0') {
            return $this->response->setBody(
                '<h5 class="card-title" style="font-size: 400%; color: #FFF017;">Inside Process</h5>'
            );
        }

        return $this->response->setBody('');
    }

    public function retrieveId()
    {
        $id = $this->request->getPost('id') ?: '';
        $result = $this->model->checkPaintingId($id);

        if ($result && $result['M_id'] == '0') {
            $data = [
                'MAT_IP_CODE' => $result['MAT_IP_CODE'] ?? '',
                'Amount' => $result['Amount'] ?? '',
                'Park' => $result['Park'] ?? '',
            ];
            return $this->response->setJSON($data);
        }

        return $this->response->setJSON([]);
    }
}

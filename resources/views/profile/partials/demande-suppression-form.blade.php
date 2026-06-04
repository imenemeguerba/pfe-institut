@php $demandeEnCours = Auth::user()->demandeSuppressionEnCours(); @endphp

@if($demandeEnCours)
    <div style="background:rgba(249,115,22,0.04);border:1px solid rgba(249,115,22,0.2);border-left:3px solid #f97316;border-radius:12px;padding:16px 20px;">
        <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:14px;flex-wrap:wrap;">
            <div>
                <p style="font-size:13px;font-weight:700;color:#f97316;margin-bottom:4px;">
                    <i class="fa-solid fa-clock"></i> Deletion request pending
                </p>
                <p style="font-size:11px;color:#9ca3af;margin-bottom:8px;">
                    Submitted on {{ $demandeEnCours->created_at->format('d/m/Y \a\t H:i') }}
                </p>
                @if($demandeEnCours->motif_demande)
                    <p style="font-size:12px;color:#374151;">
                        <strong>Your reason:</strong> {{ $demandeEnCours->motif_demande }}
                    </p>
                @endif
            </div>
            <form id="cancelDeletionForm" method="POST"
                  action="{{ route('demande-suppression.annuler', $demandeEnCours) }}"
                  style="display:none;">
                @csrf @method('DELETE')
            </form>
            <button type="button"
                onclick="showConfirmModal('fa-xmark','Cancel Deletion Request','Are you sure you want to cancel your account deletion request?','Yes, Cancel', function(){ cancelDeletionRequest(); })"
                style="padding:7px 16px;border-radius:30px;background:white;color:#ef4444;font-size:12px;font-weight:600;border:1.5px solid rgba(239,68,68,0.2);cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;display:inline-flex;align-items:center;gap:5px;flex-shrink:0;">
                <i class="fa-solid fa-xmark"></i> Cancel Request
            </button>
        </div>
    </div>

@else

    {{-- ✅ CHECK RDV FUTURS pour esthéticienne --}}
    @php
        $rdvFutursCount = 0;
        if (Auth::user()->isEstheticienne()) {
            $rdvFutursCount = Auth::user()->rendezVousAssignes()
                ->where('date_debut', '>', now())
                ->whereIn('statut', ['confirme', 'en_attente'])
                ->count();
        }
    @endphp

    @if($rdvFutursCount > 0)
        {{-- ✅ WARNING : RDV futurs présents --}}
        <div style="background:rgba(249,115,22,0.05);border:1px solid rgba(249,115,22,0.2);border-left:3px solid #f97316;border-radius:12px;padding:16px 20px;margin-bottom:16px;">
            <div style="display:flex;align-items:flex-start;gap:12px;">
                <div style="width:36px;height:36px;border-radius:10px;background:rgba(249,115,22,0.1);color:#f97316;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <p style="font-size:13px;font-weight:700;color:#f97316;margin-bottom:5px;">
                        Account deletion not available right now
                    </p>
                    <p style="font-size:12px;color:#6b7280;line-height:1.7;margin-bottom:0;">
                        You have <strong style="color:#f97316;">{{ $rdvFutursCount }} upcoming appointment{{ $rdvFutursCount > 1 ? 's' : '' }}</strong>
                        (confirmed or pending). You cannot request account deletion until all your future appointments have been completed or cancelled.
                    </p>
                </div>
            </div>
        </div>
    @else
        <p style="font-size:13px;color:#6b7280;line-height:1.8;margin-bottom:18px;">
            Account deletion is <strong style="color:#1a1a2e;">not immediate</strong>. Your request will be reviewed by the administrator,
            who will verify the absence of upcoming appointments before approving it.
        </p>

        <form id="deletionRequestForm" method="POST"
              action="{{ route('profile.demande-suppression') }}"
              style="display:none;">
            @csrf
        </form>

        <div style="margin-bottom:16px;">
            <label style="display:block;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:0.5px;color:#9ca3af;margin-bottom:6px;">
                Reason for deletion (optional)
            </label>
            <textarea id="deletionMotif" rows="3" maxlength="500"
                style="width:100%;padding:11px 14px;border-radius:10px;border:1.5px solid #ede9fe;background:#fdf9ff;font-size:13px;color:#1a1a2e;font-family:'Plus Jakarta Sans',sans-serif;outline:none;resize:vertical;transition:border-color 0.2s;"
                onfocus="this.style.borderColor='#ef4444'"
                onblur="this.style.borderColor='#ede9fe'"
                placeholder="Why do you want to delete your account?"></textarea>
        </div>

        <button type="button"
            onclick="showConfirmModal('fa-trash','Request Account Deletion','This will send a deletion request to the administrator. Your account will not be deleted immediately.','Submit Request', function(){ submitDeletionRequest(); })"
            style="padding:11px 24px;border-radius:30px;background:rgba(239,68,68,0.06);color:#ef4444;font-size:13px;font-weight:700;border:1.5px solid rgba(239,68,68,0.2);cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;display:inline-flex;align-items:center;gap:8px;transition:all 0.2s;"
            onmouseover="this.style.background='rgba(239,68,68,0.12)'"
            onmouseout="this.style.background='rgba(239,68,68,0.06)'">
            <i class="fa-solid fa-trash"></i> Request Account Deletion
        </button>
    @endif

@endif
